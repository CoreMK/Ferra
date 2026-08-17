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
  function html(tag, className, value) { return el(tag, {className, dangerouslySetInnerHTML:{__html:value || ''}}); }
  function Preview({variant, v}) {
    const link = (label) => el('a', {href:'#'}, label || 'Посилання →');
    if (variant === 'hero') return el('section',{className:'hero-editorial'},el('div',{className:'hero-copy'},html('p','kicker',v.kicker),html('h1','',v.title),el('p',{},v.copy),el('div',{},el('a',{className:'button'},v.primaryLabel),el('a',{className:'button button-quiet'},v.secondaryLabel))),el('aside',{},el('span',{},'FERRETA / 01'),el('strong',{},v.note)));
    if (variant === 'tiles') return el('section',{className:'collection-tiles'},[1,2,3].map(i=>el('a',{key:i},html('small','',v['tile'+i+'Kicker']),html('h2','',v['tile'+i+'Title']),el('span',{},v['tile'+i+'Cta']))));
    if (variant === 'categories') return el('section',{className:'space-section'},el('header',{},html('p','kicker',v.kicker),html('h2','',v.title),link(v.cta)),el('div',{className:'space-grid'},['Декоративне освітлення','Меблі лофт','Настінний декор','Малий декор','Декор для тераси','Для бізнесу'].map((name,i)=>el('a',{key:name},el('span',{},'0'+(i+1)),el('strong',{},name),el('i',{},'→')))));
    if (variant === 'products') return el('section',{className:'product-showcase'},el('div',{className:'section-head'},html('p','kicker',v.kicker),html('h2','',v.title),link(v.cta)),el('div',{className:'editor-product-placeholder'},[1,2,3,4].map(i=>el('span',{key:i}))));
    if (variant === 'sets') return el('section',{className:'sets'},el('div',{className:'section-head'},html('p','kicker',v.kicker),html('h2','',v.title)),el('div',{className:'set-list'},[1,2,3].map(i=>el('a',{key:i},el('small',{},v['set'+i+'Kicker']),el('h3',{},v['set'+i+'Title']),el('span',{},v['set'+i+'Cta'])))));
    if (variant === 'b2b') return el('section',{className:'b2b-band'},el('div',{},html('p','kicker',v.kicker),html('h2','',v.title)),el('div',{},el('p',{},v.copy),el('a',{className:'button'},v.cta)));
    return el('section',{className:'brand-journal'},el('div',{},html('p','kicker',v.brandKicker),html('h2','',v.brandTitle),link(v.brandCta)),el('div',{},html('p','kicker',v.journalKicker),el('a',{},el('small',{},'ІДЕЇ ДЛЯ ПРОСТОРУ'),el('h3',{},v.article1Title),el('span',{},v.article1Cta)),el('a',{},el('small',{},'ДЕТАЛІ'),el('h3',{},v.article2Title),el('span',{},v.article2Cta))));
  }
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
    return el('div', {className:'ferreta-home-block-editor ferreta-home-block-editor--'+variant},
      el(InspectorControls, {}, el(PanelBody, {title:'Настройки секции', initialOpen:true}, controls)),
      el('div', {className:'ferreta-home-block-editor__label'}, (variants.find(v=>v[0]===variant)||[])[1]),
      el(Preview, {variant:variant, v:values})
    );
  }
  blocks.registerBlockType('ferreta/home-section', {
    title:'Ferreta — секция главной', icon:'layout', category:'design', description:'Фирменный редактируемый блок для главной страницы Ferreta.', attributes:{variant:{type:'string',default:'hero'}}, edit:Edit, save:()=>null,
    variations: variants.map(v => ({name:v[0], title:v[1], attributes:{variant:v[0]}, isDefault:v[0]==='hero'}))
  });
})(window.wp.blocks, window.wp.element, window.wp.components, window.wp.blockEditor);
