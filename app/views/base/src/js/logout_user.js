const base_URL =
  '/web-consulado_ponta_negra-php/app/views/base/src/controllers/'

async function exitLogin(typeUrl) {
  const typeUrlString = String(typeUrl)

  console.log(typeof typeUrlString + '->' + typeUrlString)

  const dataUser = await fetch(
    origin_url + base_URL + 'authorsControllers.php?type=' + typeUrlString
  )

  location.reload()
}
