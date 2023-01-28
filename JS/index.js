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
