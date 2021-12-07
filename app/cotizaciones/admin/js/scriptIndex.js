function showToast(x){
    window.onload = function() {
        if (x == 1) {
            $('#liveToast strong').text("Error");
            $('#liveToast strong small').text("Hace menos de 1 minuto");
            $('#liveToast div.toast-body').text("No se encuentra la cotización seleccionada.");
            $('#liveToast').toast('show');

            setTimeout(function(){
                window.location.replace("index.php");
            }, 5000);

        }
    }
}