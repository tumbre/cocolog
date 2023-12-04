@section('title', 'こころのログ')

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth font-semibold">{{ __('Psycho Log') }}</h2>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 md:p-8 lg:p-12 space-y-20 sm:space-y-36">
        <div class="w-full space-y-5 md:space-y-8 mt-12">
            <div class="justify-end mt-4">
                <h2 class="text-center text-md md:text-lg mb-6">感情のマグニチュード</h2>
                <div class="flex justify-end text-third items-center mr-4">
                    <p class="bg-seventh bg-opacity-25 text-seventh text-opacity-0 border border-seventh border-opacity-100 text-xs">◯◯◯◯</p>
                    <p class="ml-1 text-end text-xs">感情的なアウトプットの量</p>
                </div>
                <canvas id="magnitude_chart"></canvas>
                <div class="flex justify-end text-third items-center ml-36 mt-2">
                    <i class="fas fa-question-circle text-2xl mr-1"></i>
                    <p class="mr-4 text-end text-xs sm:text-sm">
                        このチャートは、それぞれの日記における感情的な表現の数を点数化しています。ポジティブ・ネガティブは判定しません。</p>
                </div>
            </div>
        </div>
        <div class="w-full space-y-5 md:space-y-8">
            <div class="justify-end mt-4">
                <h2 class="text-center text-md md:text-lg mb-6">感情のクオリティ</h2>
                <div class="flex justify-end text-third items-center mr-4">
                    <p class="bg-fifth opacity-25 text-fifth text-xs">◯◯◯◯</p>
                    <p class="ml-1 mr-6 text-end text-xs">ポジティブ指数</p>
                    <p class="bg-sixth opacity-25 text-sixth text-xs">◯◯◯◯</p>
                    <p class="ml-1 text-end text-xs">ネガティブ指数</p>
                </div>
                <div><canvas id="score_chart"></canvas></div>
                <div class="flex justify-end text-third items-center ml-36 mt-2">
                    <i class="fas fa-question-circle text-2xl mr-1"></i>
                    <p class="mr-4 text-end text-xs sm:text-sm">このチャートは、それぞれの日記におけるポジティブ・ネガティブ傾向を示しています。</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // 感情のマグニチュード
    let magnitude_ctx = document.getElementById('magnitude_chart').getContext('2d');
    let magnitude_chart = new Chart(magnitude_ctx, {
        type: 'line',
        data: {
            labels: @json($formattedDates),
            datasets: [{
                data: @json($magnitude),
                titles: @json($titles),
                backgroundColor: 'rgba(193, 162, 108, 0.1)',
                borderColor: 'rgba(193, 162, 108, 1)',
                borderWidth: 1,
                lineTension: 0.5,
                pointBorderColor: 'rgba(193, 162, 108, 1)', // 点の境界線の色
                pointBorderWidth: 1, //点の境界線の幅
                pointRadius: 5, // 点の形状の半径
                pointHitRadius: 10, // マウスオーバー検出のために点半径に追加される半径(ピクセル単位)。
                pointHoverBackgroundColor: 'rgba(23, 50, 96, 1)', // マウスオーバー時の点の背景色。
                pointHoverBorderColor: 'rgba(193, 162, 108, 1)', // マウスオーバー時の点の境界線の色。
                pointHoverBorderWidth: 10, //マウスオーバー時の点の半径。
            }]
        },
        @include('components.chart_options')
    });

    // 感情のクオリティ
    let datasets = [{
        data: @json($scores),
        titles: @json($titles),
        backgroundColor: ['rgba(23, 50, 96, 0.2)']
    }]

    for (let i = 0; i < datasets[0].data.length; i++) {
        if (datasets[0].data[i] == 0.5) {
            datasets[0].backgroundColor[i] = 'rgba(0, 0, 0, 0)'
        } else if (datasets[0].data[i] > 0) {
            datasets[0].backgroundColor[i] = 'rgba(23, 50, 96, 0.2)'
        } else {
            datasets[0].backgroundColor[i] = 'rgba(235, 96, 56, 0.2)'
        }
    }

    let score_ctx = document.getElementById('score_chart').getContext('2d');
    let myPieChart = new Chart(score_ctx, {
        type: 'bar',
        data: {
            labels: @json($formattedDates),
            datasets: datasets,
        },
        @include('components.chart_options')
    });
</script>

<style>
    #chartjs-tooltip {
        opacity: 1;
        position: absolute;
        background: rgba(255, 255, 255, 0.7);
        color: black;
        border-radius: 3px;
        -webkit-transition: all .1s ease;
        transition: all .1s ease;
        pointer-events: none;
        -webkit-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
    }

    .chartjs-tooltip-key {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-right: 10px;
    }
</style>