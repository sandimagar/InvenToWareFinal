


let usericon = document.querySelector('.usericon');
let dropdownlog = document.querySelector('.dropdown_logs')
let counter = 0;
usericon.addEventListener('click',()=>{
if(counter==0){

    dropdownlog.style.opacity = 1;
    counter =1;
}
else{
    
    dropdownlog.style.opacity = 0;
    counter =0;
}
})
