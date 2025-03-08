const notificationButton = document.getElementById('notification-button')
const notificationMenu = document.getElementById('notification-menu')

notificationButton.addEventListener('click', () => {
    notificationMenu.classList.toggle('notification__menu--visible')
})