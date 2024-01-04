const bar=document.getElementById("bar");
const close=document.getElementById("close");
const nav=document.getElementById("navbar");




if(bar){bar.addEventListener('click',()=>{
    nav.classList.add('active');
})}

if(close){close.addEventListener('click',()=>{
    nav.classList.remove('active');
})}



const wrapper = document.querySelector('.wrapper');
const TeacherLink = document.querySelector('.teacher-link');
const StudentLink = document.querySelector('.student-link');
const btnPopup = document.querySelector('dropbtn');
const iconClose = document.querySelector('.icon-close');

TeacherLink.onclick =() =>{
    wrapper.classList.add('active-tpop');
}

StudentLink.onclick =() =>{
    wrapper.classList.add('active-spop');
}


iconClose.onclick =() =>{
    wrapper.classList.remove('active-tpop');
    wrapper.classList.remove('active-spop');
    // wrapper.classList.remove('active');
}
// btnPopup.onclick =() =>{
//     wrapper.classList.add('active-popup');
// }