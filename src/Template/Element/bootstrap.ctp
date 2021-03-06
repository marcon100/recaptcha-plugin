<script type="text/javascript">
    var RecaptchaOptions = {
        theme: 'custom',
        custom_theme_widget: 'recaptcha_widget'
    };
</script>
<div id="recaptcha_widget" style="display:none">
    <div class="form-group">
        <div id="recaptcha_image" style="padding: 0px; margin: auto;"></div>
        <div class="clearfix"></div>
    </div>
    <div class="recaptcha_only_if_incorrect_sol" style="color:red">
        <?= __d('re_captcha', 'Incorrect please try again') ?>
    </div>

    <div class="form-group<?= $this->Form->isFieldError('recaptcha_response_field') ? ' has-error' : ''; ?>">
        <div class="input-group">
            <span class="input-group-addon">
                <a href="javascript:Recaptcha.reload()"><span class="glyphicon glyphicon-refresh"></span></a>
            </span>

            <?=
            $this->Form->input(
                'recaptcha_response_field',
                [
                    'id' => 'recaptcha_response_field',
                    'class' => 'form-control  input-recaptcha',
                    'label' => false,
                    'error' => false
                ]
            );
            ?>

            <span class="input-group-addon">
                <a class="recaptcha_only_if_image"
                   href="javascript:Recaptcha.switch_type('audio')">
                    <span title="<?= __d('re_captcha', 'Get an audio CAPTCHA') ?>"
                          class="glyphicon glyphicon-volume-up"></span>
                </a>
            </span>
            <span class="input-group-addon">
                <a class="recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type('image')">
                    <span title="<?= __d('re_captcha', 'Get an image CAPTCHA') ?>"
                          class="glyphicon glyphicon-picture"></span>
                </a>
            </span>

        </div>
        <?php
        if ($this->Form->isFieldError('recaptcha_response_field')) {
            ?>
            <span class="help-block">
                <?= $this->Form->error('recaptcha_response_field', __d('re_captcha', 'Incorrect please try again.')) ?>
            </span>
        <?php
        } ?>
    </div>
</div>

<?= $this->Html->script($challengeAddress, ['type' => 'text/javascript']); ?>
<script type="text/javascript">
    window.onload = function () {
        var ReCaptcha = {
            audioAddon: $('<span class="input-group-addon"></span>'),
            imageAddon: $('<span class="input-group-addon"></span>')
        };

        ReCaptcha.audioAddon.append($(".recaptcha_only_if_audio").parent(".input-group-addon").html());
        ReCaptcha.imageAddon.append($(".recaptcha_only_if_image").parent(".input-group-addon").html());

        if (Recaptcha.type == "image") {
            $(".recaptcha_only_if_audio").parent(".input-group-addon").remove();
            $("#recaptcha_response_field").attr("placeholder", "<?= __d('re_captcha', 'Enter the words above') ?>");
        } else {
            $(".recaptcha_only_if_image").parent(".input-group-addon").remove();
            $("#recaptcha_response_field").attr("placeholder", "<?= __d('re_captcha', 'Enter the numbers you hear') ?>");
        }

        $(document).on('click', 'span.input-group-addon a.recaptcha_only_if_image', function () {
                $("div.input-group").append(ReCaptcha.audioAddon[0]);
                $(".recaptcha_only_if_image").parent(".input-group-addon").remove();
                $("#recaptcha_response_field").attr("placeholder", "<?= __d('re_captcha', 'Enter the numbers you hear') ?>");
            }
        );

        $(document).on('click', 'span.input-group-addon a.recaptcha_only_if_audio', function () {
                $("div.input-group").append(ReCaptcha.imageAddon[0]);
                $(".recaptcha_only_if_audio").parent(".input-group-addon").remove();
                $("#recaptcha_response_field").attr("placeholder", "<?= __d('re_captcha', 'Enter the words above') ?>");
            }
        );
    };
</script>
<noscript>
    <?=
    $this->Html->tag(
        'iframe',
        null,
        [
            'src' => $noScriptAddress,
            'height' => 300,
            'width' => 500,
            'frameborder' => 0
        ]
    ); ?>
    <br>
    <?= $this->Form->textarea('recaptcha_challenge_field', ['rows' => 3, 'cols' => 40]); ?>
    <?= $this->Form->hidden('recaptcha_response_field', ['value' => 'manual_challenge']); ?>
</noscript>
