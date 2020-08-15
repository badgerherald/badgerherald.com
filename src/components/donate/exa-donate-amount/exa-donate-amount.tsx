import { Component, State, h, EventEmitter, Event, Prop } from '@stencil/core';

@Component({
  tag: 'exa-donate-amount',
  styleUrl: 'exa-donate-amount.scss'
})
export class ExaDonateAmount {

  private defaults = [10, 25, 50, 75, 125, 250, 500] 
  
  @State() amount : number
  @Prop() reoccuring : number
  @State() isCustomAmount : boolean = false;
  @State() isTyping : boolean

  @Event() amountChanged : EventEmitter<number>
  @Event() reoccuringChanged : EventEmitter<number>

  renderAmountSection() {
    return [
      this.renderAmountGrid()
    ]
  }

  render() {
    return this.renderAmountGrid();
  }

  private setAmount(amount, custom, emit) {
    this.amount = amount 
    this.isCustomAmount = amount > 0 && custom 
    if(emit && amount > 0) {
      this.amountChanged.emit(amount)
    }
  }

  private setReoccuring(perYear) {
    this.reoccuringChanged.emit(perYear)
  }

  private renderAmountGrid() {
    return [
      <ul class="reoccuring">
        <li><a class={this.reoccuring == 12 ? "active" : ""} onClick={_ => this.setReoccuring(12)}>Monthly</a></li>
        <li><a class={this.reoccuring == 2 ? "active" : ""} onClick={_ => this.setReoccuring(2)}>Each Semester</a></li>
        <li><a class={this.reoccuring == 0 ? "active" : ""} onClick={_ => this.setReoccuring(0)}>One Time</a></li>
      </ul>,
      <div class="clearfix"></div>,
      <ul>
        {
          this.defaults.map(amount => 
            <li class="suggestion"><a class={this.amount === amount && !this.isCustomAmount ? "current" : ""} onClick={_ => this.setAmount(amount,false,true)}>${amount}</a></li>
          )
        }
        <li class="suggestion">
          <span class={((this.amount > 0 && this.isCustomAmount) || this.isTyping) ? "current custom" : "custom"} >
            <input type="number" value={this.isCustomAmount ? this.amount : ""} placeholder="1969" onFocus={_ => {this.isTyping = true; this.isCustomAmount = true} } onBlur={e => {this.isTyping = false; this.setAmount(parseInt((e.target as HTMLInputElement).value,10),true,true)} } />
          </span>
          {this.isCustomAmount || this.isTyping ? <button class="button"><span class="hidden">Submit</span></button> : undefined}
        </li>
        
      </ul>,
      <div class="clearfix"></div>,
      
    ]
  }
}
