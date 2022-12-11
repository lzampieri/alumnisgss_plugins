cd blocks & ^
npm run build & ^
cd .. & ^
npm run prod & ^
rmdir alumnisgss_profiles /s /q & ^
del alumnisgss_profiles.zip & ^
robocopy . alumnisgss_profiles /s /xd *node_modules* /xd *.git* /xf .gitignore /xf *.json /xf *.bat /xf safelist.txt /xf tailwind.config.js /xf theme.js /xf webpack.*.js /xd alumnisgss_profiles /xd src /xf *.jsx /xf .babelrc & ^
tar -acf alumnisgss_profiles.zip alumnisgss_profiles & ^
rmdir alumnisgss_profiles /s /q