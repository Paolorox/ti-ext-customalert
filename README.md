# Custom Alert Overlay Extension for TastyIgniter

A premium, highly-customizable fullscreen announcement and alert popup extension for [TastyIgniter](https://tastyigniter.com). Perfect for cookie consents, marketing announcements, policy updates, or critical site notices.

Authored by **Paolo Rossini**.

---

## Features

- **Premium Glassmorphic Design**: Modern aesthetics featuring responsive full-screen overlays with adjustable slate/pearl glass themes, backdrop blur strengths, and entrance animations.
- **Drag-and-Drop Button Configurator**: Add multiple action buttons in the backoffice. Each button is customizable with its own action (Close and Accept, or Redirect to URL), style (Primary solid, Elegant glass, Danger accent, Outline), and text.
- **View & Interaction Analytics**: Logs when a user sees the popup and records which button they clicked (Dismissed vs redirect buttons).
- **Performance Optimized (Hybrid Seen Checking)**: Prevents database bottlenecks on page load by checking client cookies first. For registered customers, it syncs with the database to prevent the popup from reappearing if they log in from another device.
- **Auto-Reset on Update**: Automatically hashes the popup content (title, message, buttons). If you update the message in the backend, the hash changes, resetting the cookies and database view logs so all users are shown the new message.
- **Dedicated Logs Dashboard**: A detailed table under *Tools > Custom Alert Logs* that is fully searchable and filterable.

---

## Requirements

- TastyIgniter version `^4.0`
- PHP `^8.1`

---

## Installation

1. Create a directory named `extensions/paolorox/customalert` in your TastyIgniter installation.
2. Extract or copy the contents of this repository into that folder.
3. Run the database migrations to register the extension and create the logs table:
   ```bash
   php artisan igniter:up
   ```
4. Clear the Laravel and TastyIgniter caches to register the routes and controllers:
   ```bash
   php artisan optimize:clear
   ```

---

##  Configuration

1. Log in to your TastyIgniter Admin Panel.
2. Navigate to **System > Settings > Custom Alert Settings**.
3. Enable the alert, write your notice using the Rich Text editor, choose your preferred design theme, and configure your action buttons.
4. Click **Save**.

---

##  View Logs

Go to **Tools > Custom Alert Logs** in the admin sidebar. Here you can search, view IP addresses, sessions, status, and track which button each customer clicked.

---

##  License

This project is licensed under the MIT License.