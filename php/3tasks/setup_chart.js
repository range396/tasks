// import { PieChart } from './piechart.js';
const cityByCount = JSON.parse(document.querySelector('.cityData').dataset.city);
const setup = () => {
    let count = 20;
    // const elements = {
    //   dogs: 0.3,
    //   cats: 0.6,
    //   dinosaurs: res,
    // };
    // const colors = {
    //   dogs: 'green',
    //   cats: 'blue',
    //   dinosaurs: 'red',
    // };

    let colors = {};
    let elements = {};

    function getRandomHexColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    for (let k in cityByCount) {
        colors[k] = getRandomHexColor()
        let num = cityByCount[k] / (100 + 1);
        elements[k] = num.toString().padEnd(num.toString().indexOf('.') + 3, '0');        
    }
    const canvas = document.getElementById('can');
    const chart = new PieChart(elements, colors, canvas);
    chart.draw();
};
setup();