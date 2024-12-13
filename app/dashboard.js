function hour_date(){
    let display_clock = document.getElementById("hour_display");
    const date = new Date();
    const hour = date.toLocaleTimeString();
    display_clock.textContent = hour;
}
setInterval(hour_date , 1000);

//Menampilkan tanggal
const dateElement = document.getElementById("current-date");
const today = new Date();

const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
const formattedDate = today.toLocaleDateString('id-ID', options);
dateElement.textContent = formattedDate;