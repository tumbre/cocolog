<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploadService
{
    public function uploadImage($request, $post)
    {
        if ($request->hasFile('image')) {
            // 更新前に保存されていた画像を削除
            $this->deleteImage($post->image);

            // オリジナルのファイル名
            $original = $request->file('image')->getClientOriginalName();

            // リサイズされた画像の一意の名前を生成
            $name = date('Ymd_His') . '_' . pathinfo($original, PATHINFO_FILENAME) . '.jpg';

            // アップロードされた画像を取得
            $uploadedImage = $request->file('image');

            // Intervention Imageを使用して画像をリサイズおよびOrientationを維持
            $resizedImage = Image::make($uploadedImage)
                ->orientate() // 画像のOrientationを考慮して回転
                ->resize(1920, 1920, function ($constraint) {
                    // アスペクト比を維持
                    $constraint->aspectRatio();
                    // サイズの拡大を防止
                    $constraint->upsize();
                })
                ->encode('jpg'); // JPEG形式に変換

            // リサイズされた画像を保存
            if (app()->isLocal()) {
                // ローカルストレージ
                $resizedImage->save(storage_path("app/public/images/{$name}"));
                $post->image = $name;
            } else {
                // S3ストレージ
                $path = Storage::disk('s3')->put('/', $resizedImage->__toString(), 'public');
                $post->image = Storage::disk('s3')->url($path);
            }

            // Intervention Imageのインスタンスを解放してリソースを解放
            $resizedImage->destroy();
        }
    }

    // 更新前の画像を削除するメソッド
    public function deleteImage($imageName)
    {
        if ($imageName) {
            if (app()->isLocal()) {
                // ローカルストレージから削除
                Storage::delete("public/images/{$imageName}");
            } else {
                // S3ストレージから削除
                Storage::disk('s3')->delete($imageName);
            }
        }
    }
}
