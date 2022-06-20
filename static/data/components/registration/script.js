document.addEventListener("DOMContentLoaded", async () => {

    document.querySelector('.registration-modal .close-btn').addEventListener('click', event => {
        event.preventDefault()
        document.querySelector('.registration-modal-layout').classList.remove('active')
    })

    document.querySelector('#map-place').addEventListener('click', async event => {
        const citySelect = document.querySelector('#city')
        const city = citySelect.options[citySelect.selectedIndex].value

        let response
        if (city === 'Алматы') {
            response  = await fetch('/admin/data/blocks/public/registration/Almaty-24-09-22.svg')
        } else {
            response  = await fetch('/admin/data/blocks/public/registration/Nur-sultan-02-09-22.svg')
        }

        let svg = await response.text()
        document.querySelector('.registration-modal .svg-wrapper').innerHTML = svg

        event.preventDefault()
        document.querySelector('#map-place').blur()
        document.querySelector('.registration-modal-layout').classList.add('active')


        document.querySelectorAll('.registration-modal .map-place').forEach(el => {
            el.addEventListener('click', onPlaceClick)
        })
    })

    function onPlaceClick(event) {
        event.preventDefault()
        const place = event.currentTarget.id.replace('map-place-', '')

        document.querySelector('#map-place').value = place
        document.querySelector('.registration-modal-layout').classList.remove('active')
    }

})