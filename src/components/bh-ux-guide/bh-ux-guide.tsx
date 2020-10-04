import { Component, h } from '@stencil/core';

@Component({
  tag: 'bh-ux-guide',
  styleUrl: 'bh-ux-guide.scss',
  shadow: true,
})
export class HeraldUxGuide {

  render() {
    return [
      <bh-uxguide-colors />,
    <bh-grid>
      <bh-headline-unit 
        headline="Wisconsin public defenders march in support of Black Lives Matter, criminal justice equality" 
        topic="State of Wisconsin" 
        url="http://google.com/"
        headerTag="h1" />

      <bh-headline-unit 
        headline="Wisconsin public defenders march in support of Black Lives Matter, criminal justice equality" 
        topic="State of Wisconsin" 
        hard={true}
        url="http://google.com/"
        headerTag="h1" />

      <bh-headline-unit 
        headline="Wisconsin public defenders march in support of Black Lives Matter, criminal justice equality" 
        topic="State of Wisconsin"
        url="http://google.com/" 
        headerTag="h2" />

      <bh-headline-unit 
        headline="Wisconsin public defenders march in support of Black Lives Matter, criminal justice equality" 
        topic="State of Wisconsin" 
        hard={true}
        url="http://google.com/"
        headerTag="h2" />

      <bh-headline-unit 
        headline="Wisconsin public defenders march in support of Black Lives Matter, criminal justice equality" 
        topic="State of Wisconsin" 
        url="http://google.com/"
        headerTag="h3" />

      <bh-headline-unit 
        headline="Wisconsin public defenders march in support of Black Lives Matter, criminal justice equality" 
        topic="State of Wisconsin" 
        hard={true}
        headerTag="h3" />
    </bh-grid>]
  }

}
