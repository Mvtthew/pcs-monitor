'use strict';

import {app, protocol, BrowserWindow, Tray, Menu} from 'electron'
import {
    createProtocol,
    installVueDevtools
} from 'vue-cli-plugin-electron-builder/lib'

const path = require('path');

const isDevelopment = process.env.NODE_ENV !== 'production';

// Keep a global reference of the window object, if you don't, the window will
// be closed automatically when the JavaScript object is garbage collected.
let win;
let tray;

// Standard scheme must be registered before the app is ready
protocol.registerStandardSchemes(['app'], {secure: true});

function createWindow() {
    // Create the browser window.
    win = new BrowserWindow({
        width: 800,
        height: 600,
        resizable: false,
        autoHideMenuBar: true
    });
    tray = new Tray(path.join(__dirname, 'logo.png'));

    let realQuit = false;

    //win.setMenu(Menu.buildFromTemplate([]));
    tray.setContextMenu(Menu.buildFromTemplate([
        {
            label: 'Show APP',
            click() {
                win.show();
            }
        },
        {
            label: 'Quit',
            click() {
                realQuit = true;
                win.close();
            }
        }
    ]));

    if (process.env.WEBPACK_DEV_SERVER_URL) {
        // Load the url of the dev server if in development mode
        win.loadURL(process.env.WEBPACK_DEV_SERVER_URL);
        if (!process.env.IS_TEST) win.webContents.openDevTools()
    } else {
        createProtocol('app');
        // Load the index.html when not in development
        win.loadURL('app://./index.html');
    }

    win.on('close', (event) => {
        if (!realQuit) {
            event.preventDefault();
            win.hide();
        }
    });
}

app.on('activate', () => {
    // On macOS it's common to re-create a window in the app when the
    // dock icon is clicked and there are no other windows open.
    createWindow();
});

// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Some APIs can only be used after this event occurs.
app.on('ready', async () => {
    createWindow()
});