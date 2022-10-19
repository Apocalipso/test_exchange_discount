const body = document.querySelector('body');
const instruction = body.querySelector('.obmen-href-modal');
const overlay = body.querySelector('.overlay');
const modalCloseButton = body.querySelector('.modal-close');
modalCloseButton.addEventListener('click',function(event){
    event.preventDefault();
    body.classList.toggle('modal');
});
instruction.addEventListener('click', function(event){
    event.preventDefault();
    body.classList.toggle('modal');
})
overlay.addEventListener('click',function(event){
    event.preventDefault();
    body.classList.toggle('modal');
})