(function () {
    const wheel = document.querySelector('.wheel')
    const startButton = document.querySelector('.button')

    const body = document.querySelector('.wrapper');

    const inputWrapper = document.querySelector('.input-wrapper')
    const emailWrapper = document.querySelector('.email-wrapper')

    const modalSocial = document.querySelector('.social-wrapper')
    // const modalForm = document.querySelector('.modal-wrapper');



    let deg = 0;
    let spins = 2;
    let zoneSize = 36; // deg

    // Counter clockwise
    const symbolSegments = {
        1: "100 rodadas grátis",
        2: "500% para o depósito",
        3: "Sem ganho",
        4: "1000R$",
        5: "15000R$",

        6: "100 rodadas grátis",
        7: "500% para o depósito",
        8: "Sem ganho",
        9: "250 rodadas grátis",
        10: "1000R$",
    }


    const wrapNumber = (str) => {
        // let str = srt;

        let arr = str.split(' ');

        let res = arr.map(word => {

            if (!isNaN(+word)) {
                return `<span class="number">${word}</span>`
            }
            return word;

        }).join(' ');

        return res;
    }

    const showPopup = (winningSymbolNr) => {
        const left = document.querySelector('.popup-left');
        const prize = left.querySelector('span')

        left.classList.add('show')

        prize.innerHTML = wrapNumber(symbolSegments[winningSymbolNr])
    }

    const showSecondPopup = (winningSymbolNr) => {
        const left = document.querySelector('.popup-right');
        const prize = left.querySelector('span')

        left.classList.add('show')

        prize.innerHTML = wrapNumber(symbolSegments[winningSymbolNr])
    }

    const showModal = () => {
        // modalForm.classList.add('show')
        modalSocial.classList.add('show')

        body.classList.add('noScroll')
    }

    const handleWin = (actualDeg) => {
        let winningSymbolNr = Math.ceil(actualDeg / zoneSize);

        spins--;
        if (winningSymbolNr == 0) winningSymbolNr = 10;

        switch (spins) {
            case 1:
                setTimeout(() => showPopup(winningSymbolNr), 300)
                break;

            default:
                startButton.removeEventListener('click', spin)
                setTimeout(() => {
                    showSecondPopup(winningSymbolNr)
                }, 500)
                setTimeout(() => {
                    showModal()
                }, 2500)
                break;
        }
    }

    const spin = () => {
        // Disable button during spin
        startButton.style.pointerEvents = 'none';

        // Calculate a new rotation between 5000 and 10 000
        // deg = (36 * Math.floor(10 * Math.random())) + 3600;
        // deg = Math.floor(5000 + Math.random() * 5000);
        if (spins == 2) {
            deg = 36 * 2 + 3600;
        } else if (spins == 1) {
            deg = 36 * 9 + 3600;
        }

        // Set the transition on the wheel
        wheel.style.transition = 'all 5s ease-out';

        // Rotate the wheel
        wheel.style.transform = `rotate(${deg}deg)`;

        // Apply the blur
        wheel.classList.add('blur');
    }

    const wheelToUsual = () => {
        // Remove blur
        wheel.classList.remove('blur');
        // Enable button when spin is over
        startButton.style.pointerEvents = 'auto';
        // Need to set transition to none as we want to rotate instantly
        wheel.style.transition = 'none';
        // Calculate degree on a 360 degree basis to get the "natural" real rotation
        // Important because we want to start the next spin from that one
        // Use modulus to get the rest value
        const actualDeg = deg % 360;
        // Set the real rotation instantly without animation
        wheel.style.transform = `rotate(${actualDeg}deg)`;
        // Calculate and display the winning symbol
        handleWin(actualDeg);
    }

    startButton.addEventListener('click', spin);

    wheel.addEventListener('transitionend', wheelToUsual);
})();
