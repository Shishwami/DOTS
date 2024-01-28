

class JsFunctions {
    static disableFormDefault(e) {
        e.preventDefault();
    }

    static disableFormButton(element) {
        element.disabled = true;
    }
}

export default JsFunctions;