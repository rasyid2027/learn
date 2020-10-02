const Marriage = () => {
    if(Jodoh() || Modal()) {
        console.log('Rabi')
    } else {
        console.log('Tunda Rabi')
    }
}

const Jodoh = () => {
    const jodoh = true
    return jodoh;
}

const Modal = () => {
    const modal = true
    return modal;
}