// funcion para validar solo numeros y punto en un campo (3 valores para enteros y 2 para decimales) ademas de n,p,a
function soloNumerosypunto(e, field) {
    key = e.keyCode ? e.keyCode : e.which

  // backspace
  if (key == 8) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    regexp = /.[0-9]{2}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // Letter N,n,P,p,A,a
  if (key == 78 || key == 110 || key == 65 || key == 97 || key == 112 || key == 80){
    return true
  }
  // other key
  return false

}
