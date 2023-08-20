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

## Trafficing advertisements

To traffic ads, you need to have access to Google Ad Manager. Reach out to the Advertising Director for access. Sidenote: If you _are_ the Advertising Director and don't have access reach out to Will Haynes on Slack.

### Forecasting inventory

Before talking to clients about placement opportunities, you should forecast a line item in Ad Manager to determine about how much inventory is available on the site for a given campaign.

#### How to check inventory in Google Ad Manager

1. Log into **[Google Ad Manager](https://admanager.google.com/)**
2. On the left, go to **Delivery** > **Orders**
3. Click **Forecasting** (next to New Order), then **Select Display Ad**
4. Under **Expected Creative** enter creative sizes (e.g. "300x250")
5. Under **Delivery Settings**: Enter a **Start Time** and **End Time** for the forecast. Also choose between **Availability Type** "max available" if you'd like to forecast the maximum inventory available, or "goal" if you're confirming specific number of impressions can be filled.
6. Click **Check inventory** at the bottom. Example:
   ![Inventory check](/img/inventory.png)

Note: The semesterly nature of publishing does affect this metric quite a bit—so you should also be looking at year over year pageviews in Google Analytics as a way to establish a guideline. If you need access to Google Analytics—reach out to Will Haynes on Slack.

### Trafficing Ads

Before trafficking (a.k.a. placing) an online ad, you should have checked available inventory. See instructions above.

#### 1. How to creating a new ad Order:

1. Log into **[Google Ad Manager](https://admanager.google.com/)**
2. On the left, go to **Delivery** > **Orders**
3. Click **New Order**.
4. Fill out the requested campaign information. (campaign name and advertiser are the only required fields. Use a descriptive name that includes the semester and year — e.g. "The Plaza - Fall 2022")

#### 2. Creating Line Items for the new Order

Once you have an order create, you need to populate it with line items. A line item is a single ad that will be trafficked on the site. You can create multiple line items for a single order.

1. Click **New Line Item**.
2. Click **Select Display Ad**.
3. Give the line item a name (e.g. "300x250 The Plaza - Long island special")
4. Under **Expected Creatives** enter the creative sizes (e.g. "300x250", "728x90")

   - Note: Line items can have multiple creative sizes, or you can create multiple line items for different creative sizes. For most campaigns, you can use one line item with multiple creative sizes, but more advanced campaigns (e.g. a/b campaigns, or campaigns that run different creatives over time) might use multiple line items.

5. Under **Delivery Settings** enter **Start Time**, **End Time** and **Quantity**.
6. Click "Check inventory" to check how confident Ad Manager is that the line item can be fulfilled. It's fine to over-traffic but it's up to the Advertising Department to:
   - Ensure clients have the correct expectations of how many impressions they will receive
   - Ensure that the same inventory is not sold to two clients at once.
7. Click **Save**.

#### 3. Defining Creatives for the new Line Item

After saving a line item, ad manager will take you to the line item's page. Here you need to define the creative that will be served for the line item.

1. Click on the **Creatives** tab.
2. Click **Add Creative** > **New Creative** > **size**
3. Select the creative's type:
   - If the client provided static .jpg/.gif/.png assets: you'll want to use **Image**
     1. Upload the images the client provided.
   - If the client supplied ad tags: select **Third Party**.
     1. Paste the ad tag into the text box. Google might warn you they don't recognize the tag. That's probably fine.
4. Click **Save and Preview**

#### 4. Previewing the Creative

To make sure the creative is going to display correctly, it's important to preview it.

1. From the Creative's page, click the **Preview** tab.
2. Click **On Site**.
3. Enter a badgerherald article page (these are usually the best to preview on) and click "Show Preview URL".
4. Copy the URL and load the page in a new tab. If all went well you should see the creative displayed on the page. You're welcome to send the URL to clients too so they can preview the creative.

#### 5. Approving the Campaign

Once you've completed the above steps, you're ready to approve the campaign. This will make the campaign live.

1. Open the Order's page.
2. Click **Approve**.

This is designed such that ad reps can traffic ads, and the Advertising Director approves them before they run.

Note, if the campaign is set to start immediately, it might take a few minutes after approving for ads from that campaign to appear on the website. That's because Google Ad Manager runs background processes to determine which ads to serve ahead of the next several page views.

### Advanced options

The above are just the basics of trafficking ads. There are a lot of advanced options that can be used to customize campaigns. It's worth browsing through options in Ad Manager to get a sense of what's possible.

## Targeting

It used to be possible to target ads based on WordPress context such at beat (News, Sports, Arts) etc. I don't think think has been used in years and I bashfully broke the functionality on Sept 4th, though I intend to fix soon and write relevant documentation<sup>3</sup>

## Known issues:

- [1] Archive pages like /news, /opinion, /arts, /sports, /banter, etc really suck right now, and someone really out to improve them, including ads!
- [2] [Issue #258](https://github.com/badgerherald/badgerherald.com/issues/258): This was working up until recently (Sept 4th). Mobile ads _should_ insert sidekicks into content within the article between paragraphs 3 and 6 and I will fix it before the end ot September.
- [3] [Issue #259](https://github.com/badgerherald/badgerherald.com/issues/259)

## Enhancement suggestions:

1. The donation stack opened up all sorts of potention to charge credit cards. What if we allowed clients (I'm thinking mostly RSOs) to purchase ads and upload creative directly?

What other advertising features is the site missing? What are clients asking for?
