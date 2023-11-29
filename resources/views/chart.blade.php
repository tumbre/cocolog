@section('title', 'こころのログ')

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth">{{ __('Psycho Log') }}</h2>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 md:p-8 lg:p-12 space-y-20 sm:space-y-36">
        <div class="w-full space-y-5 md:space-y-8 mt-12">
            <div class="justify-end mt-4 space-y-6">
                <h2 class="text-center text-md md:text-lg">感情のマグニチュード</h2>
                <canvas id="magnitude_chart"></canvas>
                <div class="flex justify-end text-third items-center ml-36">
                    <i class="fas fa-question-circle text-2xl mr-1"></i>
                    <p class="mr-4 text-end text-xs sm:text-sm">
                        このチャートは、それぞれの日記における感情的な表現の数を点数化しています。ポジティブ・ネガティブは判定しません。</p>
                </div>
            </div>
        </div>
        <div class="w-full space-y-5 md:space-y-8">
            <div class="justify-end mt-4 space-y-6">
                <h2 class="text-center text-md md:text-lg">感情のクオリティ</h2>
                <canvas id="score_chart"></canvas>
                <div class="flex justify-end text-third items-center ml-36">
                    <i class="fas fa-question-circle text-2xl mr-1"></i>
                    <p class="mr-4 text-end text-xs sm:text-sm">このチャートは、それぞれの日記におけるポジティブ・ネガティブ傾向を示しています。</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let magnitude_ctx = document.getElementById('magnitude_chart').getContext('2d');
    let magnitude_chart = new Chart(magnitude_ctx, {
        type: 'line',
        data: {
            labels: @json($formattedDates),
            datasets: [{
                label: '感情的なアウトプット',
                data: @json($magnitude),
                backgroundColor: 'rgba(193, 162, 108, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                cubicInterpolationMode: 'default',
                fill: 'start',
                lineTension: 0.3,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    let datasets = [{
        label: 'ポジティブ指数',
        data: @json($scores),
        backgroundColor: ['rgba(23, 50, 96, 0.2)']
    }]

    for (let i = 0; i < datasets[0].data.length; i++) {
        if (datasets[0].data[i] > 0) {
            datasets[0].backgroundColor[i] = 'rgba(23, 50, 96, 0.2)'
        } else {
            datasets[0].backgroundColor[i] = 'rgba(235, 96, 56, 0.2)'
        }
    }

    let ctx = document.getElementById("score_chart");
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($formattedDates),
            datasets: datasets
        },
    });
</script>
