# php-kiosk
Web based kiosk for raspberry pi
---

# WARNING: This is not meant for production uses.

You have been warned.

## Setup:
#### Note: this is meant to be done on raspbian lite

1. Install openbox + chromium + xdotool with the minimum requirements with `sudo apt-get install --no-install-recommends xserver-xorg x11-xserver-utils xinit openbox chromium-browser xdotool`
2. Copy the autostart configurations to the home folder with `mkdir .config/openbox; cp /etc/xdg/openbox/autostart ~/.config/openbox/autostart`
3. Paste the contents below into the autostart file:
    # Disable any form of screen saver / screen blanking / power management
    xset s off
    xset s noblank
    xset -dpms

    # Allow quitting the X server with CTRL-ATL-Backspace
    setxkbmap -option terminate:ctrl_alt_bksp

    # Start Chromium in kiosk mode
    xterm -e ~/chrome.sh
4. Place chrome.sh into the home folder and make it executable with `chmod +x ~/chrome.sh`
5. Start the Xserver once logged in by adding `startx -- -nocursor` into .profile
