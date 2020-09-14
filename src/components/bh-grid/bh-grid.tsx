import { Component, Listen, h, State, Host } from "@stencil/core"

@Component({
	tag: "bh-grid",
	styleUrl: "bh-grid.scss",
})
export class HeraldGrid {
	@State() grid: boolean = true

	@Listen('keydown', { target: 'document' })
	handleKeyDown(ev: KeyboardEvent) {
		if (ev.key == "~") {
			this.grid = !this.grid
		}
	}

	render() {
		return (
			<Host>
				<slot />
			</Host>
		)
	}
}
