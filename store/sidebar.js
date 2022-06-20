export const state = () => ({
	items: [
		{
			title: 'Dashboard',
			icon: 'mdi-view-dashboard-outline',
			link: '/',
			items: []
		},
		{
			title: 'Pages',
			icon: 'mdi-file-multiple-outline',
			link: '/pages',
			items: [
				{link: '/homepage', title: 'Homepage', icon: 'mdi-file'},
				{link: '/event-online', title: 'Event Online', icon: 'mdi-file'},
				{link: '/event-almaty', title: 'Event Almaty', icon: 'mdi-file'},
				{link: '/event-nur-sultan', title: 'Event Nur-sultan', icon: 'mdi-file'},
			]
		},
		{
			title: 'Media',
			icon: 'mdi-image-multiple-outline',
			link: '/media',
			items: [
				{link: '/images', title: 'Images', icon: 'mdi-image-multiple'},
				{link: '/videos', title: 'Videos', icon: 'mdi-youtube'},
				{link: '/docs', title: 'Docs', icon: 'mdi-file-document-multiple'},
			]
		},
		{
			title: 'Blocks',
			icon: 'mdi-cards-outline',
			link: '/blocks',
			items: [
				{link: '/hero', title: 'Hero', icon: 'mdi-card-bulleted'},
				{link: '/cities', title: 'Cities', icon: 'mdi-card-bulleted'},
				{link: '/events', title: 'Events', icon: 'mdi-card-bulleted'},
			]
		},
		{
			title: 'Settings',
			icon: 'mdi-cog-outline',
			link: '/settings',
			items: [
				{link: '/', title: 'Website', icon: 'mdi-application', exact: true},
				{link: '/redirects', title: 'Redirects', icon: 'mdi-arrow-up-right'},
				{link: '/styles', title: 'Styles', icon: 'mdi-code-braces'},
				{link: '/scripts', title: 'Scripts', icon: 'mdi-code-tags'},
			]
		}
	]
})

export const mutations = {
	setItems(state, items) {
		state.items = items
	}
}
