let button_package = document.querySelector('.round-button');
let month = document.querySelector('.month');
let year = document.querySelector('.year');
let button_packaging = 0;
let amount_basic = document.querySelector('.price-basic');
let amount_standard = document.querySelector('.price-standard');
let amount_professional = document.querySelector('.price-professional');
let amount_enterprise = document.querySelector('.price-enterprise');
let popularity_year = document.querySelector('.popularity-year');
let popularity_month = document.querySelector('.popularity-month')
let most_popular_month = document.getElementById('most-popular-month');
let most_popular_year = document.getElementById('most-popular-year');
let most_button_year = document.getElementById('getstared-id-year');
let most_button_month = document.getElementById('getstared-id-month');

let price_basic = 25*12 - 25;
let price_standard = 55*12 - 55;
let price_professional = 125*12 - 125;
let price_enterprise = 249*12 - 249; 

button_package.addEventListener('click',()=>{
if(button_packaging==0){
    most_button_year.classList.add("getstarted-btn");
//    amount_basic.style.fontSize = "1.5vw";
most_button_month.classList.remove('getstarted-btn');
    popularity_year.style.display = "block";
    year.style.color = "#ef233c";
    amount_basic.innerText = ` $${price_basic}`;
    amount_standard.innerText = `$${price_standard}`;
    amount_professional.innerText = `$${price_professional}`;
    amount_enterprise.innerText = `$${price_enterprise}`;
    amount_enterprise.style.color = "white";
    amount_professional.style.color = "black";

    button_packaging = 1;
    button_package.style.right = '3vw';
    popularity_month.style.display = "none";
    popularity_year.style.zIndex = 1;
    month.style.color = "black";

    most_popular_year.classList.add("most-popular");
    most_popular_month.classList.remove("most-popular");

}
else{
    amount_professional.style.color = "white";
    amount_enterprise.style.color = "black";

    most_button_year.classList.remove("getstarted-btn");
    most_button_month.classList.add('getstarted-btn');

    popularity_month.style.zIndex = 1;

    most_popular_year.classList.remove("most-popular")

    most_popular_month.classList.add("most-popular")

    amount_basic.innerText = ` $25`;
    amount_standard.innerText = `$55`;
    amount_professional.innerText = `$125`;
    amount_enterprise.innerText = `$249`;
    month.style.color = "black"


    popularity_year.style.display = "none";
    popularity_month.style.display = "block";
    
    
    button_package.style.right = '5vw';
    button_packaging=0;
    month.style.color = "#ef233c";
    year.style.color = "black";
}

})
