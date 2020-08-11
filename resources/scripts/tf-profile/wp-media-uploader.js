/* global document, wp, lang */
document.addEventListener('DOMContentLoaded', () => {
  const frames = [];
  document.querySelectorAll('[data-media-upload]').forEach((node) => {
    const name = node.getAttribute('data-media-upload');
    node.querySelector('#'+name).addEventListener('click', (event) => {
      event.preventDefault();
      if (frames[name] === undefined) {
        frames[name] = wp.media({
          title: lang.media_library_title,
          button: {
            text: lang.use_this,
          },
          multiple: false,
        });
        frames[name].on('select', () => {
          const attachment = frames[name].state().get('selection').first().toJSON();
          const preview = node.querySelector('.image-preview-wrapper');
          preview.innerHTML = '';
          if (attachment.type === 'image') {
            const img = document.createElement('img');
            img.setAttribute('src', attachment.url);
            img.className = 'media-preview';
            preview.append(img);
          } else {
            const placeholderText = document.createElement('p');
            placeholderText.className = 'filename';
            placeholderText.innerHTML = attachment.title;
            preview.append(placeholderText);
          }

          node.querySelector(`input#${name}[type=button]`).setAttribute('value', lang.change_label);
          node.querySelector('[type=hidden]').setAttribute('value', attachment.id);
        });
      }
      const frame = frames[name];
      wp.media.frames.file_frame = frame;
      frame.open();
    });
  });
});

document.querySelectorAll('[data-media-unset]').forEach((node) => {
  const name = node.getAttribute('data-media-unset');
  node.onclick = () => {
    document.querySelector(`[name=${name}]`).value = 0;
    document.querySelector(`[data-media-upload=${name}] .image-preview-wrapper`).innerHTML = '<div class="placeholder"></div>';
  };
});
