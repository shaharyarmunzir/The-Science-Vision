const slides = document.querySelectorAll(".slide");
const totalSlides = slides.length;
var counter = 0;

slides.forEach(
    (slide, index) => {
        slide.style.left = `${index * 100}%`
    });

const goPrev = () => {
    counter--;
    if (counter < 0) {
        counter = totalSlides - 1;
    }
    slideImage();
}

const goNext = () => {
    counter++;
    if (counter === totalSlides) {
        counter = 0;
    }
    slideImage();
}

const slideImage = () => {
    slides.forEach(
        (slide) => {
            slide.style.transform = `translateX(-${counter * 100}%)`
        })
}
const autoSlide = () => {
    counter++;
    if (counter === totalSlides) {
        counter = 0;
    }
    slideImage();
}

autoSlideInterval = setInterval(autoSlide, 3000); 