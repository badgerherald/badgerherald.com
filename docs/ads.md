# Ads

The Herald uses Google Ad Manager to traffic ads from both AdSense and direct sold inventory. The site does this by requesting the best ad based on a **placement** defined given the constraints of the page & client.

## Placements

Placements define supported creative sizes based on the requirements of two constraints:

- **Page**: e.g. Homepage, Article, Archive<sup>[1]</sup>
- **Device breakpoint**: e.g. Mobile, Tablet, Desktop, etc.

### Defined placements:

1. `badgerherald.com-billboard`

   - <ins>Placement</ins>: This slot loads at the top of the page, above everything else.
   - <ins>Sizes</ins>:
     - _mobile_: `300x250` (iab: medium banner)
     - _tablet & larger_: `970x250` (iab: billboard), `728x90` (iab: leaderboard)

2. `badgerherald.com-upper-sidekick`

   - **Homepage**:
     - <ins>Placement</ins>: Below "most recent"
     - <ins>Size</ins>: `300x250`
   - **Article Pages**:
     - <ins>Placement</ins>:
       - _mobile_: Not currently displayed<sup>[1]</sup>.
       - _tablet & larger_: in the article sidebar
     - <ins>Sizes</ins>: `300x250`, `300x600` (iab: half page)

3. `badgerherald.com-lower-sidekick`

   - **Homepage**:
     - <ins>Placement</ins>: Below the two top featured posts and above the content on white cards
     - <ins>Size</ins>:
       - _mobile_: `300x250`
       - _tablet_: `970x250`, `728x90`
   - **Article Pages**:
     - <ins>Placement</ins>:
       - _mobile_: Not currently displayed<sup>[2]</sup>
       - _tablet & larger_: in the article sidebar, below the upper-sidekick.
     - <ins>Sizes</ins>: `300x250`

4. `badgerherald.com-footnote-sidekick`

   - **Article Pages** (only):
     - <ins>Placement</ins>: Below the article, Next to _Next, in [section name]_
     - <ins>Size</ins>:
       - _mobile_: `300x250`
       - _tablet_: `300x600`, `300x250`

## Targeting

It used to be possible to target ads based on WordPress context such at beat (News, Sports, Arts) etc. I don't think think has been used in years and I bashfully broke the functionality on Sept 4th, though I intend to fix soon and write relevant documentation<sup>3</sup>

## Trafficing advertisements

To traffic ads, you need to have access to Google Ad Manager. Reach out to the Advertising Director for access. Sidenote: If you _are_ the Advertising Director and don't have access reach out to Will Haynes on Slack.

### Inventory

Before talking to clients about placement opportunities, you should traffic a line item in Ad Manager to determine about how much inventory is available on the site for a given campaign. Note that semesterly nature of publishing does affect this metric quite a bit—so you should also be looking at year over year pageviews in Google Analytics as a way to establish a guideline. If you need access to Google Analytics—reach out to Will Haynes on Slack.

#### How to trafficking ads

<sup>[4]</sup>

## Known issues:

- [1] Archive pages like /news, /opinion, /arts, /sports, /banter, etc really suck right now, and someone really out to improve them, including ads!
- [2] [Issue #258](https://github.com/badgerherald/badgerherald.com/issues/258): This was working up until recently (Sept 4th). Mobile ads _should_ insert sidekicks into content within the article between paragraphs 3 and 6 and I will fix it before the end ot September.
- [3] [Issue #259](https://github.com/badgerherald/badgerherald.com/issues/259)
- [4] [Issue #260](https://github.com/badgerherald/badgerherald.com/issues/260): Someone should add some documentation (mostly: screenshots) documenting how to do this for new ad reps

## Enhancement suggestions:

1. The donation stack opened up all sorts of potention to charge credit cards. What if we allowed clients (I'm thinking mostly RSOs) to purchase ads and upload creative directly?

What other advertising features is the site missing? What are clients asking for?
