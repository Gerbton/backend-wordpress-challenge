class Subscription {
    constructor() {
        this.subscribeForm = document.getElementById('jsFuerzaSubscribeForm');
    }

    handleSubmit() {
        const $ = jQuery;

        this.subscribeForm.addEventListener('submit', (event) => {
            event.preventDefault();
            let form = $(this.subscribeForm);

            $.ajax({
                url: subscribeData.endpoints.create.url,
                method: subscribeData.endpoints.create.method,
                dataType: 'json',
                data: form.serialize(),
                success: (response) => {
                    console.log(response, 'deu boa');
                }
            });
        });
    }
}

new Subscription().handleSubmit();