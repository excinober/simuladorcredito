//Cambiar el input del select de archivo o imágen
$('.custom-file-input').on('change',function(e){
    //get the file name
    var fileName = e.target.files[0].name;
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
});

$('.custom-file-label').css({"line-height":"1.5rem", "font-weight":"bold"});