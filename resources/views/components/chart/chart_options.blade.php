options: {
    legend: {
        display: false
    },
    scales: {
        yAxes: [{
            ticks: {
              beginAtZero: true
            }
        }]
    },
    onClick: function(event, elements) {
        let indexesArray = @json($indexes);
        
        if (elements[0]._index >= 0 && elements[0]._index < indexesArray.length) {
            let dynamicUrl = "post/" + indexesArray[elements[0]._index];
            location.href = dynamicUrl;
        } else {
            console.error("Invalid index or index not found in $indexes array");
        }
    },
    tooltips: {
        // 元々のツールチップを無効化
        enabled: false,
        custom: function(tooltipModel) {
            // ツールチップ要素を定義
            let tooltipEl = document.getElementById('chartjs-tooltip');
    
            // 最初の表示時に要素を生成
            if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'chartjs-tooltip';
                tooltipEl.innerHTML = "<table class='text-xs lg:text-sm'></table>";
                this._chart.canvas.parentNode.appendChild(tooltipEl);
            }
    
            // ツールチップが無ければ非表示
            if (tooltipModel.opacity === 0) {
                tooltipEl.style.opacity = 0;
                return;
            }
    
            function getBody(bodyItem) {
                return bodyItem.lines;
            }
    
            // メタデータの取得
            let index = tooltipModel.dataPoints[0].index;
            let title = this._chart.data.datasets[0].titles[index];
    
            // テキストをセット
            if (tooltipModel.body) {
                let titleLines = tooltipModel.body.map(getBody);
                let bodyLines = tooltipModel.body.map(getBody);
    
                let innerHtml = '<thead>';
    
                titleLines.forEach(function(x, i) {
                    innerHtml = `<tr><th> ${title} </th></tr>`;
                });
                innerHtml += '</thead><tbody>';
    
                bodyLines.forEach(function(body, i) {
                    let colors = tooltipModel.labelColors[i];
                    let style = `background:${colors.backgroundColor};`;
                    style += `border-color:${colors.borderColor};`;
                    style += `border-width: 2px;`;
                });
                innerHtml += '</tbody>';
    
                let tableRoot = tooltipEl.querySelector('table');
                tableRoot.innerHTML = innerHtml;
            }
            // `this`はツールチップ全体
            let positionY = this._chart.canvas.offsetTop;
            let positionX = this._chart.canvas.offsetLeft;
    
            // 表示、位置、フォントスタイル指定
            tooltipEl.style.opacity = 1;
            tooltipEl.style.left = positionX + tooltipModel.caretX + 'px';
            tooltipEl.style.top = positionY + tooltipModel.caretY + 'px';
            tooltipEl.classList.add('p-2');
        }
    }
}