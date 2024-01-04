<p align="center">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="./dark.png">
    <img alt="UnoSignal Logo'" src="./light.png">
  </picture>
</p>

<h1 align="center">Uno for Unofficial. Uno for One – ¡Ole!</h1>

<p align="center">
  An unofficial OneSignal / WordPress Integration. I currently work at OneSignal, however this is in no way affiliated to OneSignal. If you're looking for the official plugin, go here: <a href="https://wordpress.org/plugins/onesignal-free-web-push-notifications/">OneSignal WordPress Plugin</a>
</p>

## Overview

- 🚀 Initialises the latest OneSignal Web SDK (v16).
- ⏩ Automatically sends Push Notifications when a WordPress post is published.
- 💬 Setup [prompts](https://documentation.onesignal.com/docs/permission-requests) within the OneSignal dashboard. No custom code required.
- 🧑‍🤝‍🧑 Choose which [Segment](https://documentation.onesignal.com/docs/segmentation) should recieve notifications for each post.
- 📑 [Web Topics](https://documentation.onesignal.com/docs/web-push-topic-collapsing) included by default.
- 📲 Send to mobile app subscribers, with an option to direct them to a different URL ([Deep Link](https://documentation.onesignal.com/docs/links#deep-linking)).

## Download

- Click **Code** at the top right of this repository and select **Download ZIP** <br/>
  <img width="410" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/b0a745bd-adda-49c3-bbd6-6a8f9e295d68">

## Install

- In your WordPress admin screen, click **Plugins** -> **Add New Plugin** -> **Upload Plugin** -> **Choose file** <br/>
  <img width="774" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/ea2d2db9-cf71-4bca-a846-776c9d924e50" style="margin-bottom:30px">
- Choose **onesignal-main.zip** and click **Open** <br/>
  <img width="774" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/8d482e66-81ee-40b5-a851-961a94a64163" style="margin-bottom:30px">
- Click **Install Now** <br/>
  <img width="470" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/533cce31-d7b4-4a99-a8c7-1d91f8cbb9aa" style="margin-bottom:30px">
- Click **Activate Plugin** <br/>
  <img width="774" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/b1b94bf4-d2e4-4a74-87b0-567cf47ccf1b" style="margin-bottom:30px">
- You're done, and should see **UnoSignal** in your admin menu <br/>
  <img width="188" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/ff6951f0-fda9-4194-853a-66fd03686049" style="margin-bottom:30px">

## Setup

### Requirements

- A [OneSignal account](https://dashboard.onesignal.com/signup).
- A [OneSignal app](https://documentation.onesignal.com/docs/web-push-quickstart), with Web Platform enabled.
- The OneSignal App Id and REST API Key ([Keys and IDs](https://documentation.onesignal.com/docs/keys-and-ids)).

### OneSignal.com

1. On the Web Platform configuration page, choose **Typical Site Setup**
2. On the **Typical Site Setup** screen, under Advanced Push Settings, switch on **Customize service worker paths and filenames**
3. Where it asks for **Path to service worker files** and **Service worker registration scope**, enter `/wp-content/plugins/unosignal/service_worker/` (screenshot below).
4. Where it asks for **Main service worker filename** and **Updater service worker filename**, enter `OneSignalSDKWorker.js` (screenshot below).
5. Save the Settings page. You'll be directed to a new page with **Upload Files** and **Add Code to Site**, ignore this and click **Finish** at the bottom of the page.
<img width="410" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/775a9ce2-5edb-486e-8123-ec6f48a161a2">


### UnoSignal WordPress Plugin Settings

1. Enter the OneSignal App Id and REST API Key ([Keys and IDs](https://documentation.onesignal.com/docs/keys-and-ids)).
2. Save Changes
3. You should see a check below each field. That's it, we're done!
<img width="1240" alt="image" src="https://github.com/marclucraft/unosignal/assets/3025406/5c73c1d6-af68-4cd3-a63d-6a98dfdd5e9f">

