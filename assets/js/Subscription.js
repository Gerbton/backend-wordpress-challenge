class Subscription {
    constructor() {
        this.subscribeForm = document.getElementById('jsFuerzaSubscribeForm');
        this.handleValidation();
    }

    handleValidation() {
        let validateRules = {
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: 'É necessário informar um nome',
                email: {
                    required: "É necessário informar um e-mail",
                    email: "Este não é um e-mail válido"
                }
            }
        };

        jQuery(this.subscribeForm).validate(validateRules);
    }

    handleSubmit() {
        const $ = jQuery;

        this.subscribeForm.addEventListener('submit', (event) => {
            event.preventDefault();
            let form = $(this.subscribeForm);

            form.find('#jsFCFormMessage').remove();

            if (!form.valid()) {
                return;
            }

            BlockUI.block(form[0]);

            $.ajax({
                url: subscribeData.endpoints.create.url,
                method: subscribeData.endpoints.create.method,
                dataType: 'json',
                data: form.serialize(),
                success: (response) => {
                    if (!response.success) {
                        return;
                    }

                    let linkToSubscribe = document.getElementById('jsLinkToSubscribe');

                    window.open(linkToSubscribe.href, '_blank');
                }
            }).done((response) => {
                form.append(`<p id="jsFCFormMessage">${response.data}</p>`)
                BlockUI.unblock(form[0]);
            });
        });
    }
}

new Subscription().handleSubmit();