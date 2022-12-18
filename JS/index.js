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
