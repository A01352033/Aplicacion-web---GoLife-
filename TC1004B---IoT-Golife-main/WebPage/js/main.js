//Obtener una referencia al elemento canvas del DOM
const $grafica = document.querySelector("#grafica");
//las etiquetas son las que van en el eje X
const etiquetas =["Girasol", "Calendula", "Petunia", "Maiz"]
//podemos tener varios conjuntos de datos, comencemos por uno
const datosRTemp2022 = {
    label: "Temperatura real de anuales",
    data: [20, 25, 15, 10],
    backgroundColor: 'rgba(54,162 ,235 , 0.2)', //Color del fondo
    borderColor: 'rgba(54, 162, 235, 1)', //Color del borde
    borderWidth: 1, //Ancho del borde
};

const datosFTemp2022 = {
    label: "Temperatura no real de anuales",
    data: [10, 5, 20, 25],
    backgroundColor:'rgba(75, 192, 192, 0.2)',
    borderWidth: 1,

};

new Chart($grafica, {

    type: 'bar', //Tipo de grafica
    data: {
        labels: etiquetas,
        datasets: [
            datosRTemp2022,
            datosFTemp2022,
            //Aqui mas datos
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});