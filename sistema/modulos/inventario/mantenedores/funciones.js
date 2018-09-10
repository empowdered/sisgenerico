function validateIp(idForm)
{
    //Creamos un objeto
    object=document.getElementById(idForm);
    valueForm=object.value;
 
    // Patron para la ip
    var patronIp=new RegExp("^([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})$");
    //window.alert(valueForm.search(patronIp));
    // Si la ip consta de 4 pares de números de máximo 3 dígitos
    if(valueForm.search(patronIp)==0)
    {
        // Validamos si los números no son superiores al valor 255
        valores=valueForm.split(".");
        if(valores[0]<=255 && valores[1]<=255 && valores[2]<=255 && valores[3]<=255)
        {
            //Ip correcta
            object.style.color="#000";
            return;
        }
    }
    //Ip incorrecta
    object.style.color="#f00";
}
