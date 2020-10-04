import { Component, Listen, Host, h } from "@stencil/core"

@Component({
	tag: "bh-sticky-container",
	styleUrl: "bh-sticky-container.scss",
})
export class HeraldStickyContainer {
	private stickyEl: HTMLElement
	private headerBox: HTMLElement
	private headerEl: HTMLElement

	@Listen('resize', { target: 'window' })
	@Listen('scroll', { target: 'window' })
	handleScroll(_) {
		var stickyTop = this.stickyEl.getBoundingClientRect().top;
		var containerBottom = this.stickyEl.getBoundingClientRect().bottom;
		this.headerEl.style.width = this.stickyEl.getBoundingClientRect().width + "px"
		if(32 + this.headerEl.firstElementChild.clientHeight > containerBottom) {
			this.stickyEl.classList.add("stuck");
			this.stickyEl.classList.remove("sticky");
		} else if (32 > stickyTop) {
			this.stickyEl.classList.add("sticky");
			this.stickyEl.classList.remove("stuck");
			this.headerBox.style.height = (this.headerEl.firstElementChild.clientHeight) + "px"
  		} else {
			this.stickyEl.classList.remove("sticky");
			this.stickyEl.classList.remove("stuck");
			this.headerBox.style.height = "0px"
  		}
	}

	render() {
		return (
			<Host ref={ref => this.stickyEl = ref}>
				<div ref={ref => this.headerBox = ref} />
				<span class="header" ref={ref => this.headerEl = ref}>
					<slot name="header" />
				</span>
				<slot name="content" />
			</Host>
		)
	}
}
