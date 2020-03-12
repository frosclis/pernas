<link href="/utils/scwCookie/output/assets/scwCookie.min.css" rel="stylesheet" type="text/css">
<div class="scw-cookie<?= $this->decisionMade ? ' scw-cookie-out' : ''; ?>">
    <div class="scw-cookie-panel-toggle scw-cookie-panel-toggle-<?= $this->config['panelTogglePosition']; ?>"
        onclick="scwCookiePanelToggle()"
    >
        <span class="scwc-icon scwc-icon-cookie"></span>
    </div>
    <div class="scw-cookie-content">
        <div class="scw-cookie-message">
            <?php $liveChatMessage = $this->config['showLiveChatMessage'] ? ', provide live chat' : ''; ?>
            Usamos cookies para analizar el tráfico de nuestra web <?= $liveChatMessage; ?>.
        </div>
        <div class="scw-cookie-decision">
            <div class="scw-cookie-btn" onclick="scwCookieHide()">OK</div>
            <div class="scw-cookie-settings scw-cookie-tooltip-trigger"
                onclick="scwCookieDetails()"
                data-label="Configuración de Cookies"
            >
                <span class="scwc-icon scwc-icon-settings"></span>
            </div>
            <div class="scw-cookie-policy scw-cookie-tooltip-trigger" data-label="Política de cookies">
                <a href="<?= $this->config['cookiePolicyURL']; ?>">
                    <span class="scwc-icon scwc-icon-policy"></span>
                </a>
            </div>
        </div>
        <div class="scw-cookie-details">
            <div class="scw-cookie-details-title">Gestiona tus cookies</div>
            <div class="scw-cookie-toggle">
                <div class="scw-cookie-name">Cookies esenciales del sitio web</div>
                <label class="scw-cookie-switch checked disabled">
                    <input type="checkbox" name="esenciales" checked="checked" disabled="disabled">
                    <div></div>
                </label>
            </div>
            <?php foreach ($this->enabledCookies() as $name => $label) { ?>
                <div class="scw-cookie-toggle">
                    <div class="scw-cookie-name" onclick="scwCookieToggle(this)"><?= $label; ?></div>
                    <label class="scw-cookie-switch<?= $this->isAllowed($name) ? ' checked' : ''; ?>">
                        <input type="checkbox"
                        name="<?= $name; ?>"
                        <?= $this->isAllowed($name) ? 'checked="checked"' : ''; ?>
                        >
                        <div></div>
                    </label>
                </div>

                <?php } ?>
            </div>
        </div>
    </div>
    <script src="/utils/scwCookie/output/assets/js-cookie.js" type="text/javascript"></script>
    <script src="/utils/scwCookie/output/assets/scwCookie.js" type="text/javascript"></script>
