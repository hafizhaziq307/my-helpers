/**
 * Check if value is empty
 * @param {any} val
 * @returns {bool}
 */
function isEmpty(val) {
  if (Array.isArray(val)) return !val.length;
  if (typeof val === "object") return !Object.keys(val).length;
  return !val;
}

/**
 * Replace value if string value is empty
 * @param {string} val
 * @param {string} replaceWith
 * @returns {string}
 */
function setDefaultStr(val, replaceWith) {
  if (typeof val === "string" || val === null || val === undefined) {
    return !val ? replaceWith : val;
  }
  return val;
}

/**
 * Convert special character into html entities
 * @param {string} text
 * @returns {string}
 */
function encodeStr(text) {
  return text.replace(/[&<>"'\/]/g, (char) => {
    return {
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#39;",
      "/": "&#x2F;",
    }[char];
  });
}

/**
 * Extract color from image
 * @param {<img />} imageElement
 * @returns {string} // hexcode
 */
async function extractColor(imageElement) {
  const canvas = document.createElement("canvas");
  const ctx = canvas.getContext("2d");

  await new Promise(
    (resolve) => (imageElement.onload = () => resolve(imageElement))
  );

  canvas.width = imageElement.width;
  canvas.height = imageElement.height;
  ctx.drawImage(imageElement, 0, 0, canvas.width, canvas.height);

  // Get the image data from the canvas
  const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  const data = imageData.data;

  let r = 0;
  let g = 0;
  let b = 0;
  let count = 0;

  for (let i = 0; i < data.length; i += 4) {
    r += data[i];
    g += data[i + 1];
    b += data[i + 2];
    count++;
  }
  r = Math.floor(r / count);
  g = Math.floor(g / count);
  b = Math.floor(b / count);

  return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1)}`;
}
