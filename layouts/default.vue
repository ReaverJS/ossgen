<template>
	<v-app>

		<v-navigation-drawer permanent app :width="current.items.length ? 300 : 0">
			<v-sheet class="ml-14 text-center pa-4" color="grey lighten-2"  v-if="current.items.length">
				<h2 class="text-h2">{{current.title}}</h2>
			</v-sheet>

			<v-list nav class="ml-14">
				<v-list-item link v-for="item in current.items" :to="current.link + item.link" nuxt :key="item.title" :exact="item.exact">
					<v-list-item-action>
						<v-icon>{{ item.icon }}</v-icon>
					</v-list-item-action>

					<v-list-item-content>
						<v-list-item-title>{{ item.title }}</v-list-item-title>
					</v-list-item-content>
				</v-list-item>
			</v-list>
		</v-navigation-drawer>

		<v-navigation-drawer dark mini-variant-width="56" permanent app width="200" mini-variant  expand-on-hover>
			<v-list nav>
				<v-list-item link v-for="item in items" :to="item.link" nuxt :key="item.title">
					<v-list-item-action>
						<v-icon>{{ item.icon }}</v-icon>
					</v-list-item-action>

					<v-list-item-content>
						<v-list-item-title>{{ item.title }}</v-list-item-title>
					</v-list-item-content>
				</v-list-item>
			</v-list>
		</v-navigation-drawer>

		<v-main>
			<v-container>
				<Nuxt/>
			</v-container>
		</v-main>
	</v-app>
</template>

<script>
import {mapState, mapMutations} from 'vuex'

export default {
	name: 'DefaultLayout',
	computed: {
		...mapState({
			items: state => state.sidebar.items
		}),
		current: function () {
			return this.items.find(item => {
				return (this.$nuxt.$route.path.startsWith(item.link) && item.link !== '/')
					|| (item.link === this.$nuxt.$route.path)
			})
		}
	},
	methods: {
		...mapMutations({
			setItems: 'sidebar/setItems'
		}),
	}
}
</script>
