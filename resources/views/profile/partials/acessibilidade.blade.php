<!-- Plugin de Acessibilidade -->
<div id="accessibility-plugin">
  <button id="accessibility-button" aria-label="Abrir menu de acessibilidade"><img src="https://cdn.userway.org/widgetapp/images/body_wh.svg" alt="acessibilidade" width="40"></button>

  <div id="accessibility-menu" aria-hidden="true">
    <div class="menu-header">
      <h3>Menu Acessibilidade</h3>
      <small>(CTRL+U)</small>
    </div>
    <div class="options-grid">
      <button onclick="cycleFontSize()">
        <span>🔠</span>
        <strong>Texto Maior</strong>
      </button>
      <button onclick="cycleSpacing()">
        <span>↔️</span>
        <strong>Espaçamento</strong>
      </button>
      <button onclick="cycleContrast()">
        <span>🌗</span>
        <strong>Contraste</strong>
      </button>
      <button onclick="resetAccessibility()">
        <span>♻️</span>
        <strong>Redefinir</strong>
      </button>
    </div>
  </div>
</div>

<script>
  const button = document.getElementById('accessibility-button');
  const menu = document.getElementById('accessibility-menu');

  let fontStage = 0;
  let spacingStage = 0;
  let contrastStage = 0;

  button.addEventListener('click', () => {
    const visible = menu.style.display === 'flex';
    menu.style.display = visible ? 'none' : 'flex';
    menu.setAttribute('aria-hidden', visible.toString());
  });

  function cycleFontSize() {
    document.body.classList.remove(`font-${fontStage}`);
    fontStage = (fontStage + 1) % 5;
    if (fontStage > 0) {
      document.body.classList.add(`font-${fontStage}`);
    }
  }

  function cycleSpacing() {
    document.body.classList.remove(`spacing-${spacingStage}`);
    spacingStage = (spacingStage + 1) % 5;
    if (spacingStage > 0) {
      document.body.classList.add(`spacing-${spacingStage}`);
    }
  }

  function cycleContrast() {
    document.body.classList.remove('contrast-light', 'contrast-dark', 'contrast-invert');
    contrastStage = (contrastStage + 1) % 4;
    if (contrastStage === 1) {
      document.body.classList.add('contrast-light');
    } else if (contrastStage === 2) {
      document.body.classList.add('contrast-dark');
    } else if (contrastStage === 3) {
      document.body.classList.add('contrast-invert');
    }
  }

  function resetAccessibility() {
    document.body.classList.remove(
      `font-${fontStage}`,
      `spacing-${spacingStage}`,
      'contrast-light',
      'contrast-dark',
      'contrast-invert'
    );
    fontStage = 0;
    spacingStage = 0;
    contrastStage = 0;
  }
</script>

<style>
  /* Plugin Layout */
  #accessibility-plugin {
    position: fixed;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
  }
   /* Mobile: canto esquerdo inferior */
  @media (max-width: 576px) {
    #accessibility-plugin {
      top: auto;
      bottom: 20px;
      left: 20px;
      transform: none;
    }
  }

  #accessibility-button {
    background-color: #145156;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
    transition: all 0.3s;
  }

  #accessibility-button:hover {
    transform: scale(1.1);
  }

  #accessibility-menu {
    display: none;
    flex-direction: column;
    margin-top: 10px;
    background: #fff;
    padding: 16px;
    border-radius: 14px;
    width: 280px;
    box-shadow: 0 0 20px rgba(0,0,0,0.25);
    animation: fadeIn 0.3s ease-in-out;
  }

  .menu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    color: #145156;
  }

  .menu-header h3 {
    margin: 0;
    font-size: 18px;
  }

  .menu-header small {
    font-size: 12px;
    color: #888;
  }

  .options-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }

  .options-grid button {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #f6f6f6;
    padding: 12px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    font-size: 13px;
    transition: background 0.3s;
    height: 80px;
    justify-content: center;
  }

  .options-grid button:hover {
    background: #e1f3fa;
  }

  .options-grid span {
    font-size: 20px;
    margin-bottom: 5px;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* TEXTO MAIOR - Não afeta o plugin */
  body.font-1 :not(#accessibility-plugin *),
  body.font-2 :not(#accessibility-plugin *),
  body.font-3 :not(#accessibility-plugin *),
  body.font-4 :not(#accessibility-plugin *) {
    font-size: inherit;
  }

  body.font-1 :not(#accessibility-plugin *) { font-size: 110% !important; }
  body.font-2 :not(#accessibility-plugin *) { font-size: 111% !important; }
  body.font-3 :not(#accessibility-plugin *) { font-size: 112% !important; }
  body.font-4 :not(#accessibility-plugin *) { font-size: 115% !important; }

  /* ESPAÇAMENTO - Não afeta o plugin */
  body.spacing-1 p:not(#accessibility-plugin *),
  body.spacing-1 li:not(#accessibility-plugin *) {
    line-height: 1.6; letter-spacing: 0.5px;
  }

  body.spacing-2 p:not(#accessibility-plugin *),
  body.spacing-2 li:not(#accessibility-plugin *) {
    line-height: 1.8; letter-spacing: 1px;
  }

  body.spacing-3 p:not(#accessibility-plugin *),
  body.spacing-3 li:not(#accessibility-plugin *) {
    line-height: 2.0; letter-spacing: 1.5px;
  }

  body.spacing-4 p:not(#accessibility-plugin *),
  body.spacing-4 li:not(#accessibility-plugin *) {
    line-height: 2.2; letter-spacing: 2px;
  }

  /* CONTRASTE - Não afeta o plugin */
  body.contrast-light :not(#accessibility-plugin *) {
    background-color: #fdfdfd !important;
    color: #111 !important;
  }

  body.contrast-dark :not(#accessibility-plugin *) {
    background-color: #111 !important;
    color: #fff !important;
  }

  body.contrast-invert :not(#accessibility-plugin *) {
    filter: invert(1) hue-rotate(180deg);
  }
</style>
