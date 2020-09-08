import { Component, h, Prop, Element } from '@stencil/core';

@Component({
  tag: 'exa-search-form',
  styleUrl: 'exa-search-form.scss',
  
})
export class ExaSearchForm {
	@Prop() focused : boolean

	@Element() el

	render() {
	  return (
	    <form class={this.focused ? "search focused" : "search"} action="/" method="get">
	      <input type="text" name="s" placeholder="Search..."  onFocus={_ => this.el.classList.add('focused')} onBlur={_ => this.el.classList.remove('focused')}></input>
	      <input type="submit" value="Submit"></input>
	    </form> 
	  );
	}

}
