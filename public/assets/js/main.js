
if(window.location.href.includes('/html') || window.location.href.includes('/css') || window.location.href.includes('/js')) {
    const buttonNext = document.querySelector('#button-next');
    console.log(buttonNext);
    buttonNext.setAttribute('disabled', 'disabled');
    // Si l'alerte de notification d'exercice réussi est activé, on active le button
    // if(l'alerte a été activé) {
    //    buttonNext.removeAttribute('disabled');
    //     buttonNext.addEventListener('click', () => {
    //      alert('test button');
    //     });
    // }
    
}
 