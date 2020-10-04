import { Component, h } from '@stencil/core';

const Swatch = (props, children) => [
  <span class={"swatch " + props.slug}>
    <span class="caption big">{props.name}</span>
    <span class="caption">{props.details}</span>
  </span>
  ,children
];

@Component({
  tag: 'bh-uxguide-colors',
  styleUrl: 'bh-uxguide-colors.scss',
})
export class BhUXGuideColors {

  render() {
    return <bh-grid class="colors">
      <Swatch slug="herald-blue" name="Herald Blue" details="Primary Herald Blue" />
      <Swatch slug="support-blue" name="Support Blue" details="Used for outreach often with 📰💙" />

      <Swatch slug="banter-red" name="Banter Red" details={"Differentiates Banter content"} />
    </bh-grid>
  }

}
