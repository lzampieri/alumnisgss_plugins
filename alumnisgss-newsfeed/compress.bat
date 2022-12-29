cd blocks & ^
npm run build & ^
cd .. & ^
npm run prod & ^
rmdir alumnisgss_newsfeed /s /q & ^
del alumnisgss_newsfeed.zip & ^
robocopy . alumnisgss_newsfeed /s /xd *node_modules* /xd *.git* /xf .gitignore /xf *.json /xf *.bat /xf safelist.txt /xf tailwind.config.js /xf theme.js /xf webpack.*.js /xd alumnisgss_newsfeed /xd src /xf *.jsx /xf .babelrc & ^
tar -acf alumnisgss_newsfeed.zip alumnisgss_newsfeed & ^
rmdir alumnisgss_newsfeed /s /q