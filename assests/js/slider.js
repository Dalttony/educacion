const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider_section");
let sliderSectionLast = sliderSection[sliderSection.length -1];

const btnleft = document.querySelector("#btn_left");
const btnright = document.querySelector("#btn_right");
slider.insertAdjacentElement('afterbegin' , sliderSectionLast);


function next(){

	let sliderSectionFirst = document.querySelectorAll(".slider_section")[0];
	slider.style.maginleft = "-200%";
	slider.style.transition = "all 0.5s";
	setTimeout(function(){
	slider.style.transition = "none";
	slider.insertAdjacentElement('beforeend' , sliderSectionFirst);
	slider.style.maginleft = "-100%";
	},500);
}

function prev(){

	 let sliderSection = document.querySelectorAll(".slider_section");
let sliderSectionLast = sliderSection[sliderSection.length -1];
	slider.style.maginleft = "0%";
	slider.style.transition = "all 0.5s";
	setTimeout(function(){
	slider.style.transition = "none";
 slider.insertAdjacentElement('afterbegin' , sliderSectionLast);
	slider.style.maginleft = "-100%";
	},500);
}
btn_right.addEventListener('click',function(){
	next();
});



btn_left.addEventListener('click',function(){
	prev();
});

setInterval(function(){
	next();

},7000);