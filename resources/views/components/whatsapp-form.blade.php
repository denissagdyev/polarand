<div class="whatsapp-form">
    <div class="whatsapp-form__inner">
        <div class="whatsapp-form__left">
            <div class="whatsapp-form__social">
                <p class="soc">НАПИШЕМ В</p>
                <a href="https://api.whatsapp.com/send?phone=79850945520" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://t.me/ndsmaster1" target="_blank">
                    <i class="fab fa-telegram"></i>
                </a>
            </div>
            <p class="whatsapp-form__subtitle">ПРИШЛЕМ ПРИМЕРЫ РАБОТ, <br>ОТВЕТИТЕ, КОГДА БУДЕТ УДОБНО</p>
        </div>

        <div class="whatsapp-form__right">
            <form action="{{ route('send.whatsapp') }}" method="POST">
                @csrf
                <div class="whatsapp-form__input-group">
                    <input type="tel" id="whatsapp_number" name="whatsapp_number" placeholder="Ваш WhatsApp" required>
                    <button type="submit" class="whatsapp-form__button">Отправить</button>
                </div>
                @error('whatsapp_number')
                    <div class="whatsapp-form__error">{{ $message }}</div>
                @enderror
                <div class="whatsapp-form__checkbox">
                    <input type="checkbox" id="personal_data" name="personal_data" value="1" checked required>
                    <label for="personal_data">Я согласен на <a href="files/privacy_policy_polarspa.pdf">обработку персональных данных</a></label>
                </div>
            </form>
        </div>
    </div>
</div>