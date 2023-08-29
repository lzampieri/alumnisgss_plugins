cd blocks & ^
npm run build & ^
cd .. & ^
npm run prod & ^
rmdir alumnisgss_sponsors /s /q & ^
del alumnisgss_sponsors.zip & ^
robocopy . alumnisgss_sponsors /s /xd *node_modules* /xd *.git* /xf .gitignore /xf *.json /xf *.bat /xf safelist.txt /xf tailwind.config.js /xf theme.js /xf webpack.*.js /xd alumnisgss_sponsors /xd src /xf *.jsx /xf .babelrc & ^
tar -acf alumnisgss_sponsors.zip alumnisgss_sponsors & ^
rmdir alumnisgss_sponsors /s /q