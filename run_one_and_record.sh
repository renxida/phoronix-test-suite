benchname=$1
mkdir /home/xr5ry/benchtaker/pts-out-0717/$benchname/
export LINUX_PERF="perf stat -x, -a --append -o /home/xr5ry/benchtaker/pts-out/$benchname/perf-output.csv --delay 3000 --interval-print 2000  -e cycles,r0248,r0480,r0CA3,r40D1,r8889,r0283,r3824,r010D,r01C5,r8189,rF824 "
yes $'y\n1' | timeout 2h ./phoronix-test-suite debug-benchmark $benchname
