# Grid

Exa is designed on a grid system based on four breakpoints for screen widths. For each breakpoint, an assumed minimum width is used to calculate the percentage that each column should use.

On wider breakpoints, more columns are added. Column width and gutter sizes remain constant

| Breakpoint        | Assumed min width   | # of columns   | column width | gutter width |
| ----------------- | ------------------- | -------------- | ------------ | ------------ |
| **mobile**        | 280px               | 3              | 60px         | 20px         |
| **tablet**        | 740px               | 9              | 60px         | 20px         |
| **desktop**       | 1020px              | 13             | 60px         | 20px         |
| **xl**            | 1180px              | 15             | 60px         | 20px         |


## Sass Helper functions 

#### Flex()

The table above defines widths in pixels, because pixels are easy to think in. However, widths for most
elements should be defined in percentages. To abstract this, use the `flex(base,width)` sass function

Parameters: 
 - `base`: The number of pixels an element should (a total of column widths and gutter widths)
 - `width`: Assumed min width from the table above.

For example, 

```

@breakpint("tablet") {
	.3-col-container {
		width: flex(220,740); // 220 = 60 + 20 + 60 + 20 + 60
	}
}

@breakpoint("desktop") {
	.2-col-container {
		width: flex(140,1020); // 140 = 60 + 20 + 60
	}
}


```