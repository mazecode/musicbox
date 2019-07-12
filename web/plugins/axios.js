export default function({ $axios, redirect }) {
  $axios.onRequest(config => {
    console.log('Making request to ' + config.url)
  })

  $axios.onResponse(response => response);
  $axios.onRequestError(err => console.log);
  $axios.onResponseError(err => console.log)

  $axios.onError(error => {
    const code = parseInt(error.response && error.response.status)
    if (code === 400) {
      redirect('/400')
    }
    console.log(error)
  })
}
