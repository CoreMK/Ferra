(function (blocks, element, components, blockEditor) {
  const el = element.createElement;
  const InspectorControls = blockEditor.InspectorControls;
  const PanelBody = components.PanelBody;
  const TextControl = components.TextControl;
  const TextareaControl = components.TextareaControl;
  const SelectControl = components.SelectControl;
  const variants = [
    ['hero', 'Hero'], ['tiles', 'Три плитки'], ['categories', 'Категории'],
    ['products', 'Витрина товаров'], ['sets', 'Подборки'], ['b2b', 'B2B'], ['journal', 'Бренд и журнал']
  ];
  const labels = {
    kicker: 'Надзаголовок', title: 'Заголовок (можно <br> и <em>)', copy: 'Текст', cta: 'Текст ссылки', url: 'Ссылка', note: 'Подпись справа',
    primaryLabel: 'Основная кнопка', primaryUrl: 'Ссылка основной кнопки', secondaryLabel: 'Вторая кнопка', secondaryUrl: 'Ссылка второй кнопки',
    brandKicker: 'Бренд: надзаголовок', brandTitle: 'Бренд: заголовок', brandCta: 'Бренд: ссылка', brandUrl: 'Бренд: URL', journalKicker: 'Журнал: надзаголовок',
    article1Title: 'Статья 1: заголовок', article1Cta: 'Статья 1: ссылка', article1Url: 'Статья 1: URL', article2Title: 'Статья 2: заголовок', article2Cta: 'Статья 2: ссылка', article2Url: 'Статья 2: URL'
  };
  function pretty(key) { return labels[key] || key.replace(/([A-Z])/g, ' $1').replace(/^./, c => c.toUpperCase()); }
  function Edit(props) {
    const variant = props.attributes.variant || 'hero';
    const defaults = FerretaHomeBlocks.defaults[variant] || {};
    const values = Object.assign({}, defaults, props.attributes);
    const fields = Object.keys(defaults);
    const controls = [el(SelectControl, {label: 'Тип секции', value: variant, options: variants.map(v => ({label:v[1],value:v[0]})), onChange: value => props.setAttributes({variant:value})})].concat(fields.map(key => {
      const isLong = /title|copy/.test(key);
      const Control = isLong ? TextareaControl : TextControl;
      return el(Control, {key, label: pretty(key), value: values[key] || '', onChange: value => props.setAttributes({[key]:value})});
    }));
    const heading = values.title || values.brandTitle || (variants.find(v=>v[0]===variant)||[])[1];
    const caption = values.copy || values.kicker || values.brandKicker || 'Динамический блок Ferreta';
    return el('div', {className:'ferreta-home-block-editor ferreta-home-block-editor--'+variant},
      el(InspectorControls, {}, el(PanelBody, {title:'Настройки секции', initialOpen:true}, controls)),
      el('div', {className:'ferreta-home-block-editor__label'}, (variants.find(v=>v[0]===variant)||[])[1]),
      el('h2', {dangerouslySetInnerHTML:{__html:heading}}),
      el('p', {}, caption),
      el('p', {className:'ferreta-home-block-editor__hint'}, 'Откройте правую панель блока, чтобы изменить текст, кнопки и ссылки. Перетаскивайте секцию за шесть точек слева.')
    );
  }
  blocks.registerBlockType('ferreta/home-section', {
    title:'Ferreta — секция главной', icon:'layout', category:'design', description:'Фирменный редактируемый блок для главной страницы Ferreta.', attributes:{variant:{type:'string',default:'hero'}}, edit:Edit, save:()=>null,
    variations: variants.map(v => ({name:v[0], title:v[1], attributes:{variant:v[0]}, isDefault:v[0]==='hero'}))
  });
})(window.wp.blocks, window.wp.element, window.wp.components, window.wp.blockEditor);
