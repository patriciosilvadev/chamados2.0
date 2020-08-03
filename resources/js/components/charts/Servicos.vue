<template>
    <canvas id="chart-servicos"></canvas>
</template>
<script>
export default {
    data() {
        return {
            colors: {
                background: [],
                border: []
            }
        };
    },
    methods: {
        fetch() {
            axios
                .get("/charts/servicos")
                .then(result => {
                    this.newChart(result.data);
                })
                .catch(errors => console.log(errors));
        },
        labels(data) {
            let keys = [];
            for (var i in data) {
                keys.push(i);
            }
            this.colorGenerate(data);
            return keys;
        },
        chartData(datas) {
            let data = [];
            for (var i in datas) {
                data.push(datas[i]);
            }
            return data;
        },
        colorGenerate(data){
            let color = '';
            for (var i in data) {
                color = 'rgba(' + Math.floor(Math.random() * 255) + ', ' + Math.floor(Math.random() * 255) + ', ' + Math.floor(Math.random() * 255);
                this.colors.background.push(color + ', 0.2)');
                this.colors.border.push(color + ', 1)');
            }
        },
        newChart(data) {
            new Chart(document.getElementById('chart-servicos'), {
                type: "doughnut",
                data: {
                    labels: this.labels(data),
                    datasets: [
                        {
                            label: "Chamados/Setor",
                            data: this.chartData(data),
                            backgroundColor: this.colors.background,
                            borderColor: this.colors.border,
                            borderWidth: 1
                        }
                    ]
                },
            });
        }
    },
    created() {
        this.fetch();
    }
};
</script>
