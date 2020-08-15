import { Component, Prop, h } from '@stencil/core';


@Component({
  tag: 'exa-donate-nav',
  styleUrl: 'exa-donate-nav.scss'
})
export class ExaDonateSpinner {

  @Prop() isCheckout : boolean
  
  @Prop() amount : number 

  private selectAmount() {

  }

  private selectCheckout() {
    if(this.isCheckout) {
      return 
    }
    if(this.amount <= 0) {
      return 
    } 
  }

  render() {
    return <ul>
      <li><a onClick={_ => this.selectAmount()}>Amount</a></li>
      <li><a onClick={_ => this.selectCheckout()}>Checkout</a></li>
    </ul>
  }
}
